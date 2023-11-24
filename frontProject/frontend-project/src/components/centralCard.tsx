import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from "react-icons/fa";
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import {useEffect, useState} from 'react';
import api from "../api/dataapi.tsx";
import DropdownButton from 'react-bootstrap/DropdownButton';
import ChartTs from './chart.tsx';

export function CentralCard(){

    let[data, setData] = useState(null);
    let[currencyFrom, setCurrencyFrom] = useState(null);
    let[currencyTo, setCurrencyTo] = useState(null);
    let[priceFrom, setPriceFrom] = useState(null)
    let[priceTo, setPriceTo] = useState(null)

    const selectItemFrom = (name:string, price:float) => {
        setCurrencyFrom(name);
        setPriceFrom(price);
    }

    const selectItemTo = (name:string, price:float) => {
        setCurrencyTo(name);
        setPriceTo(price);
    }

    const invertItems = () =>{
        setCurrencyFrom(setCurrencyTo);
        setCurrencyTo(setCurrencyFrom);
        setPriceFrom(setPriceTo);
        setPriceTo(setPriceFrom);
    }

    const request = [];
    useEffect(()=>{
        const getData = async () =>{
            await api.get('currency')
                .then(response => {
                    setData(response.data);
                })
        }
        getData()
    }, []);

    data?.forEach(element => {
        request.push(element);
    });

    // request.forEach(element => {
    //     console.log(element.Price)
    // });
    // // console.log(data);
    // // const converter = () => {
    // //     request.price
    // // }


    return(
        <Container style={{backgroundColor:"transparent",
        padding:"0", 
        margin: "50px auto", 
        width: "100%", 
        height: "100vh", 
        borderRadius:"10px"}}>
           <Container>
                 <Row>
                    <Col>
                        <Container style={{
                            marginTop: "10px",
                            padding: "10px",
                            borderRadius:"10px", 
                            marginRight: "0",
                            height: "50vh", 
                            backgroundColor: "transparent",
                            }}>
                                <Container style={{
                                    padding: "10px",
                                    borderRadius:"10px",
                                    height:"50%",
                                    backgroundColor:"#212121",
                                    boxShadow:" 0px 2px 4px black"
                                    }}>
                                    <Row>
                                        <Col>
                                            <h9 style={{color:"white"}}>De:</h9>
                                            <Card style={{backgroundColor:"#373737"}}>
                                                <Card.Body style={{padding:"0"}}>
                                                <Dropdown>
                                                        <Dropdown.Toggle
                                                        style={{border:"hidden", color:"white"}}  
                                                        variant="outline-secondary" 
                                                        id="dropdown-basic">
                                                            {currencyFrom}
                                                        </Dropdown.Toggle>
                                                        
                                                            <Dropdown.Menu style={{
                                                                height: "20vh",
                                                                width: "12vw",  
                                                                overflow: "auto",
                                                                borderRadius: "10px",
                                                                backgroundColor:"#212121",
                                                                
                                                                }}>
                                                                    {data?.map((result =>  
                                                                        <Dropdown.Item style={{color:"white"}}
                                                                            onClick={() => selectItemFrom(result.name, result.Price)}>
                                                                                {result.symbol} - {result.name}
                                                                        </Dropdown.Item>
                                                                    ))}
                                                            </Dropdown.Menu>
                                                    </Dropdown>

                                                    <Container style={{height:"10vh", marginTop:"5vh"}}>
                                                        <h9 style={{color:"white"}}>R$ {priceFrom}</h9>
                                                    </Container>

                                                </Card.Body>
                                            </Card>

                                                {/* <Dropdown className="d-grid">
                                                    <h9>De:</h9>
                                                    <Dropdown.Toggle variant="outline-secondary" id="dropdown-basic">
                                                        Dropdown Button
                                                    </Dropdown.Toggle>
                                                </Dropdown> */}

                                        </Col>
                                            <Col md="auto" style={{textAlign:"center" }}>
                                            <div style={{marginTop:"150%"}}>
                                                <Button className="btn" style={{
                                                    borderRadius: "40px", 
                                                    textAlign:"center", 
                                                    border:"none",
                                                    backgroundColor:"transparent"                                                    
                                                    }}
                                                    onClick={()=> invertItems()}>
                                                    <i><FaExchangeAlt style={{color:"#14FFEC"}}/></i>
                                                </Button>  
                                            </div>                                  
                                            </Col>
                                            <Col>
                                        <h9 style={{color:"white"}}>Para:</h9>
                                        <Card style={{backgroundColor:"#373737"}}>
                                            <Card.Body style={{padding:"0"}}>
                                                <Dropdown>
                                                    <Dropdown.Toggle
                                                     style={{border:"hidden", color:"white"}}  
                                                     variant="outline-secondary" 
                                                     id="dropdown-basic">
                                                        {currencyTo}
                                                    </Dropdown.Toggle>
                                                    
                                                        <Dropdown.Menu style={{
                                                            height: "20vh",
                                                            width: "12vw",  
                                                            overflow: "auto",
                                                            borderRadius: "10px"}}>
                                                                {data?.map((result =>  
                                                                    <Dropdown.Item 
                                                                        onClick={() => selectItemTo(result.name, result.Price)}>
                                                                            {result.symbol} - {result.name}
                                                                    </Dropdown.Item>
                                                                ))}
                                                        </Dropdown.Menu>
                                                </Dropdown>

                                                 <Container style={{height:"10vh", marginTop:"5vh"}}>
                                                   <h9 style={{color:"white"}}>R$ {priceTo}</h9>
                                                </Container>
                                            </Card.Body>
                                        </Card>
                                        </Col>
                                    </Row>
                                </Container>
                               <Row>
                                    <Col>
                                        <Container style={{
                                            marginTop: "1vh",
                                            padding: "10px",
                                            borderRadius:"10px",
                                            height:"23vh",
                                            backgroundColor:"#212121",
                                            boxShadow:" 0px 2px 4px black"
                                            }}>
                                        </Container>  
                                    </Col>
                                    <Col>
                                        <Container style={{
                                            marginTop: "1vh",
                                            padding: "10px",
                                            borderRadius:"10px",
                                            height:"23vh",
                                            backgroundColor:"#212121",
                                            boxShadow:" 0px 2px 4px black"
                                            }}>
                                        </Container>  
                                    </Col>
                                </Row>                                        
                            {/* CRIAR OUTRO CONTAINER */}
                        </Container>
                        
                    </Col>
                    <Col>
                    <Container style={{
                            marginTop: "10px",
                            padding: "10px",
                            borderRadius:"10px", 
                            marginRight: "0",
                            height: "50vh", 
                            backgroundColor: "transparent",
                            }}>
                    {/* Container GRAFICO */}
                        <Container style={{
                                        padding: "10px",
                                        borderRadius:"10px",
                                        height: "100%", 
                                        backgroundColor:"#212121",
                                        boxShadow:" 0px 2px 4px black",
                                        }}>
                            
                            <Dropdown>
                                                        <Dropdown.Toggle
                                                        style={{border:"hidden", color:"#14FFEC"}}  
                                                        variant="outline-secondary" 
                                                        id="dropdown-basic">
                                                            {currencyFrom}
                                                        </Dropdown.Toggle>
                                                        
                                                            <Dropdown.Menu style={{
                                                                height: "20vh",
                                                                width: "12vw",  
                                                                overflow: "auto",
                                                                borderRadius: "10px",
                                                                backgroundColor:"#212121",
                                                                
                                                                }}>
                                                                    {data?.map((result =>  
                                                                        <Dropdown.Item style={{color:"white"}}
                                                                            onClick={() => selectItemFrom(result.name, result.Price)}>
                                                                                {result.symbol} - {result.name}
                                                                        </Dropdown.Item>
                                                                    ))}
                                                            </Dropdown.Menu>
                                                    </Dropdown>
                                <ChartTs/> 
                        </Container>
                    {/* Container GRAFICO */}        
                    </Container>
                    </Col>
                </Row> 
                
                
           </Container>

        </Container>
    )
}