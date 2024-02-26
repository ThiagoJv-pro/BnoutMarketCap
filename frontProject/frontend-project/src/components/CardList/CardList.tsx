import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from 'react-icons/fa';
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import {useEffect, useState} from 'react';
import api from '../../api/dataapi.tsx';
import DropdownButton from 'react-bootstrap/DropdownButton';
import ListGroup from 'react-bootstrap/ListGroup';
import './style.scss';


const CardList = () => {

    const[typeCoin, setTypeCoin] = useState(null);
    const[data, setData] = useState(null);
    const[data2, setData2] = useState(null);
    const[stateToggle, setStateToggle]= useState(null);

    useEffect(()=>{
        const getData = async  () => {
           await api.get('/listCoin', {
            params: {
                currency: 'c'
            }
           })
           .then(response => {
            setData(response.data)
           })
        }
            getData()
    }, [])
    
    useEffect(()=>{
        const getData2 = async  () => {
            await api.get('/listCoin', {
                params: {
                    currency: 't'
                }
            })
            .then(response => {
             setData2(response.data)
            })
         }
            getData2()
    }, [])

    return(
        <>
            <Row>
                <Col>
                    <Container className='card-main'>
                        <Container className='card-list '>
                            <ListGroup>
                                { data?.map((result => 
                                    <ListGroup.Item action className='list'>
                                        <p className='coins'>{result.symbol} | ${result.Price}</p>
                                        <p className='coins'>{result.name}</p>
                                    </ListGroup.Item>
                                    )) }    
                            </ListGroup>
                        </Container>  
                    </Container>  
                </Col>
                <Col>
                    <Container className='card-main'>
                        <Container className='card-list'> 
                                    <ListGroup className='list-group-list'>
                                            { data2?.map((result => 
                                                <ListGroup.Item action className='list'>
                                                    <p className='coins'>{result.symbol} | ${result.Price}</p>
                                                    <p className='coins'>{result.name}</p>
                                                </ListGroup.Item>
                                                )) } 
                                    </ListGroup>      
                        </Container>
                    </Container>  
                </Col>
            </Row>
        </>
    )
}

export default CardList;