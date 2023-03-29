$( document ).ready(function() {

    /**
     * Calling the function responsible for the 
     * AJAX request for a report on user actions
     */

    let buy_cow = document.getElementById("BUY_COW");
    let chart_cow = new Chart(buy_cow, {
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
                text: 'All statistics click “Buy a cow“'
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

    let download_exe = document.getElementById("DOWNLOAD_EXE");
    let chart_exe = new Chart(download_exe, {
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
                text: '"All statistics click "Download exe"'
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

    ajaxQuery(chart_cow, chart_exe, user_id, start_data, finish_data);

    function ajaxQuery(chart_cow, chart_exe, user_id, start_data, finish_data) {

        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'json',
            url: '/',
            data: { action: "report", events: ["BUY_COW", "DOWNLOAD_EXE"], userId: user_id, startData: start_data, finishData: finish_data },
            success: function (data) {

                let array_data = JSON.parse(data.message);

                for (let i in array_data[0]) {
                    chart_cow.data.labels.push(array_data[0][i].event_date);
                    chart_cow.data.datasets[0].data.push(array_data[0][i].count_buy);
                    let colors = generateNewColor();
                    chart_cow.data.datasets[0].backgroundColor.push(colors);
                }
                chart_cow.update();
                for (let i in array_data[1]) {
                    chart_exe.data.labels.push(array_data[1][i].event_date);
                    chart_exe.data.datasets[0].data.push(array_data[1][i].count_buy);
                    let colors = generateNewColor();
                    chart_exe.data.datasets[0].backgroundColor.push(colors);
                }
                chart_exe.update();
            }
        });
    }

    $('#send').on('click', function() {

        let user_id = document.querySelector('#select_user').value;
        let start_data = document.querySelector('input[id="start"]').value;
        let finish_data = document.querySelector('input[id="finish"]').value;
        chart_cow.data.labels = [];
        chart_cow.data.datasets[0].data = [];
        chart_cow.data.datasets[0].backgroundColor = [];
        chart_cow.update();
        chart_exe.data.labels = [];
        chart_exe.data.datasets[0].data = [];
        chart_exe.data.datasets[0].backgroundColor = [];
        chart_exe.update();
        ajaxQuery(chart_cow, chart_exe, user_id, start_data, finish_data);
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
