document.addEventListener('DOMContentLoaded', function() {
    // Get a reference to the <div> element by its ID
    var consumer = document.getElementById('consumer');
    var market = document.getElementById('market');

    var fname = document.getElementById('fname');
    var lname = document.getElementById('lname');

    var marketname = document.getElementById('marketname');

    // Attach a click event listener to the <div> element
    consumer.addEventListener('click', function() {
        consumer.className = 'chosen';
        market.className = 'normal';

        fname.style.display = 'block';
        lname.style.display = 'block';
        marketname.style.display = 'none';
    });
    market.addEventListener('click', function() {
        market.className = 'chosen';
        consumer.className = 'normal';

        fname.style.display = 'none';
        lname.style.display = 'none';
        marketname.style.display = 'block';
    });

});