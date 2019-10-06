particlesJS.load('particles-js', '/beatsaber/particles.json', function() {
  console.log('callback - particles.js config loaded');
});

var Leaderboard = {
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
    }
}
