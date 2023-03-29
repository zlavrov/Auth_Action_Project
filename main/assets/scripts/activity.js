$( document ).ready(function() { 

    /**
     * Calling the function responsible for the 
     * AJAX request for a report on user actions
     */

    let view_a = document.getElementById("VIEW_A");
    let chart_a = new Chart(view_a, {
        type: "bar",
        data: {
            labels: [],
            datasets: [{
                backgroundColor: [],
                data: []
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "All statistics view page A"
            }, scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });

    let view_b = document.getElementById("VIEW_B");
    let chart_b = new Chart(view_b, {
        type: "bar",
        data: {
            labels: [],
            datasets: [{
                backgroundColor: [],
                data: []
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "All statistics view page B"
            }, scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });

    let user_id = document.querySelector('#select_user').value;
    let start_data = document.querySelector('input[id="start"]').value;
    let finish_data = document.querySelector('input[id="finish"]').value;

    ajaxQuery(chart_a, chart_b, user_id, start_data, finish_data);

    function ajaxQuery(chart_a, chart_b, user_id, start_data, finish_data) {

        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'json',
            url: '/',
            data: { action: "activity", events: ["VIEW_A", "VIEW_B"], userId: user_id, startData: start_data, finishData: finish_data },
            success: function (data) {
    
                let array_data = JSON.parse(data.message);
    
                for (let i in array_data[0]) {
                    chart_a.data.labels.push(array_data[0][i].event_date);
                    chart_a.data.datasets[0].data.push(array_data[0][i].count_buy);
                    let colors = generateNewColor();
                    chart_a.data.datasets[0].backgroundColor.push(colors);
                }
                chart_a.update();
                for (let i in array_data[1]) {
                    chart_b.data.labels.push(array_data[1][i].event_date);
                    chart_b.data.datasets[0].data.push(array_data[1][i].count_buy);
                    let colors = generateNewColor();
                    chart_b.data.datasets[0].backgroundColor.push(colors);
                }
                chart_b.update();
            }
        });
    }

    $('#send').on('click', function() {

        let user_id = document.querySelector('#select_user').value;
        let start_data = document.querySelector('input[id="start"]').value;
        let finish_data = document.querySelector('input[id="finish"]').value;
        chart_a.data.labels = [];
        chart_a.data.datasets[0].data = [];
        chart_a.data.datasets[0].backgroundColor = [];
        chart_a.update();
        chart_b.data.labels = [];
        chart_b.data.datasets[0].data = [];
        chart_b.data.datasets[0].backgroundColor = [];
        chart_b.update();
        ajaxQuery(chart_a, chart_b, user_id, start_data, finish_data);
    });

    const hexCharacters = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F"];

    function getCharacter(index) {
        return hexCharacters[index]
    }
    
    function generateNewColor() {
        let hexColorRep = "#"
    
        for (let index = 0; index < 6; index++){
            const randomPosition = Math.floor ( Math.random() * hexCharacters.length ) 
            hexColorRep += getCharacter( randomPosition )
        }
        
        return hexColorRep
    }
});
