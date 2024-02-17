import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from "react-icons/fa";
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import {useEffect, useState} from 'react';
import api from '../../api/dataapi.tsx';
import DropdownButton from 'react-bootstrap/DropdownButton';
import ChartC from '../Chart/Chart.tsx';
import './style.scss';

const Analytics = () => {

    let[data, setData] = useState(null);
    let[currencyFrom, setCurrencyFrom] = useState(null);
    let[currencyTo, setCurrencyTo] = useState(null);
    let[symbolTo, setSymbolTo] = useState(null);
    let[symbolFrom, setSymbolFrom] = useState('BTC');
    let[priceFrom, setPriceFrom] = useState(null)
    let[priceTo, setPriceTo] = useState(null)

    const selectItemFrom = (name:string, price:float, symbol:string) => {
        setCurrencyFrom(name);
        setPriceFrom(price);
        setSymbolFrom(symbol)
    }

    const selectItemTo = (name:string, price:float, symbol:string) => {
        setCurrencyTo(name);
        setPriceTo(price);                      
        setSymbolTo(symbol)
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
        request.push(element)
    });

    return(
    <>
        <Container className='card-info' onClick={'title'}>
                 <span className='title'>Analytics</span>
         </Container>
    
         <Container className='card-main-chart'>
                            
            <Dropdown>
                                                        <Dropdown.Toggle
                                                        style={{border:"hidden", color:"#14FFEC"}}  
                                                        variant="outline-secondary" 
                                                        id="dropdown-basic">
                                                            {currencyFrom}
                                                        </Dropdown.Toggle>
                                                        
                                                            <Dropdown.Menu className='dropdown-menu-chart'>
                                                                    {data?.map((result =>  
                                                                        <Dropdown.Item style={{color:"white"}}
                                                                            onClick={() => selectItemFrom(result.name, result.Price, result.symbol)}>
                                                                                {result.symbol} - {result.name}
                                                                        </Dropdown.Item>
                                                                    ))}
                                                            </Dropdown.Menu>
                                                    </Dropdown>
                            <ChartC cryptoCurrency={symbolFrom}/> 
                        </Container>
    </>
    )
}

export default Analytics;