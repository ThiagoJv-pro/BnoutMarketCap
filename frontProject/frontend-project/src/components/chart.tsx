import {ApexOptions} from 'apexcharts';
import Chart from 'react-apexcharts';

const ChartTs = () => {
    const type = 'area';
    const generateRandomData = () => {
        const dataPoints = 20; // Número de pontos de dados
        const startDate = new Date('2023-01-01').getTime(); // Data inicial em milissegundos
        const endDate = new Date('2023-01-10').getTime(); // Data final em milissegundos
        const seriesData = [];

        for (let i = 0; i < dataPoints; i++) {
            const randomTimestamp = i;
            const randomValue = i + 1;
            seriesData.push({
                x: randomTimestamp,
                y: randomValue
            });
        }

        return seriesData;
    };

    const series = [{
        name: 'Random Data',
        data: generateRandomData()
    }];

    const HISTORIC_CHART: ApexOptions = {
        chart: {
            animations: {
                enable: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enable: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                },
            },
            type: type,
            zoom: {
                autoScaleYaxis: true
            }
        },
        markers: {
            size: 5, 
            colors: ['#14FFEC'],
          },

        fill: {
            colors: ['#14FFEC'],
            type: 'gradient',
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.4,
              opacityTo: 0.5,
              stops: [0, 100]
            }
        },
        
        dataLabels: {
            enabled: false,
            style: {
              colors: ['#373737']
            }
          },
      
        xaxis: {
            type: 'numeric',
            tickAmount: 4,
            tickPlacement: 'on', 
            labels:{
                style:{
                    colors: ['white']
                }
            }     
        },

        yaxis: {
            tooltip: {
                enable: true,
            },
            label: {
                show: true,
                text: 'support'
            },
            labels: {
                style: {
                    colors: ["white"]
                },
            },
        }
    }

    return(
        <div>
            <p></p>
            <div>
                <div >
                    <Chart  options={HISTORIC_CHART} series={series} type={type} height={"300vh"}/>
                </div>
            </div>
        </div>
    );
};

export default ChartTs;



