import {ApexOptions, Props} from 'apexcharts';
import Chart from 'react-apexcharts';
import api from "../../api/dataapi.tsx";
import {useEffect, useState} from 'react';
import {axiosChart} from '../../helpers/ChartTsHelper.ts';
import './style.scss';

const ChartC = ({cryptoCurrency}: any) => {
    const seriesData = [];
    const dataChart = [];
    var [data, setData] = useState(null);
    const type = 'area';

        useEffect(() =>{
            const getData = async() => {
                await api.get('/chart/' + cryptoCurrency)
                .then(response => {
                    setData(response.data);
                })    
            }
           getData();
        }, [cryptoCurrency]) // Adiciona cryptoCurrency como dependência do useEffect


    
    const series = [{
        name: 'Price',
        data: axiosChart(data)
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
        },

        tooltip: {
            x: {
              format: 'dd MMM yyyy'
            }
          },
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

export default ChartC;



