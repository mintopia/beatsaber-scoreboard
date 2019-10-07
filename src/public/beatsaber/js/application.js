particlesJS.load('particles-js', '/beatsaber/particles.json', function() {
  console.log('callback - particles.js config loaded');
});

var Leaderboard = {
    pusherConfig: {},
    pusher: null,

    updateScores: function(scores) {
        var html = '<table>';
        jQuery(scores).each(function (index, score) {
            var formattedScore = score.score.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");;
            html += '<tr><td>' + score.name + '</td>';
            html += '<td class="score">' + formattedScore + '</td></tr>';
        });
        html += '</table>';
        jQuery('#leaderboard').html(html);
    },

    updateName: function(name) {
        jQuery('#name').html(name);
    },

    connect: function() {
        this.pusher = new Pusher(this.pusherConfig.key, {
            wsHost: this.pusherConfig.host,
            wsPort: this.pusherConfig.port,
            wssPort: this.pusherConfig.port,
            authEndpoint: '/laravel-websockets/auth',
            disableStats: true,
            auth: {
                headers: {
                    'X-App-ID': this.pusherConfig.appId
                }
            },
            forceTLS: this.pusherConfig.forceTLS
        });
        this.pusher.subscribe(this.pusherConfig.channel).bind('competition.update', function (data) {
            Leaderboard.updateFromJSON(data);
        });
        this.pusher.subscribe(this.pusherConfig.channel).bind('competition.refresh', function (data) {
            location.reload(true);
        });
    },

    updateFromJSON: function(data) {
        if (!data) {
            return;
        }
        this.updateName(data.leaderboard.name);
        this.updateScores(data.leaderboard.scores);
    }
}
