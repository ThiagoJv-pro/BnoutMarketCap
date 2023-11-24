import Marquee from "react-fast-marquee";
import api from "../api/dataapi.tsx";
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import {useEffect, useState} from 'react';

export function News() 
{
  let [data, setData] = useState(null) ;
  const request = [];
  const style={color: '#14FFEC'}
  useEffect(()=>{
    const getData = async ()=> {
      await api.get('/cryptocurrency')
          .then(response => {
            setData(response.data);
        })
      }
      getData()
  },[]);

  data?.forEach((element) => {
    request.push(element)
  });


    return(
       
        <Container style={{margin: "10px auto"}}>
          <Marquee pauseOnHover={true} speed={80} style={{
            backgroundColor:"#212121",
            borderRadius: "30px",
            boxShadow: "0px 2px 4px black"
           }}>
            
            {data?.map((result, index)=>{
              return(
                <div style={{ marginRight: '50px'}}>
                  <h9 style={style}> {result ? result.name: "null"} - ${result ? result.price: "null"}</h9>
                </div>
              )
            })}
           
          </Marquee>
          </Container>
    );
}

export default News;
