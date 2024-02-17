export function axiosChart(dataChart)
{   
    const days = [];
    const seriesData = [];
    
    for(let i = 0; i < 31; i++){
        days.push(i);
    }

    dataChart?.forEach((element) => {
        seriesData.push({
            x: element.Date,
            y: element.CurrentValue
        });
    })

    return seriesData;
}