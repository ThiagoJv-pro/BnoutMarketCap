import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import {useEffect, useState} from 'react';
import api from '../../api/dataapi.tsx';
import CardInfo from '../CardInfo/CardInfo.tsx';
import Modals from '../Modal/Modal.tsx';
import EmailService from './email.service.ts';
 
import './style.scss';

const CardEmail = () => {


    const[isSubmitted, setIsSubmitted] = useState(false);
    const[email, setEmail] = useState('');
    const[coin, setCoin] = useState('All');
    const [showModal, setShowModal] = useState(false);

    const emailForm = (event) => {
        setEmail(event.target.value); 
    }
    const coinForm = (event) => {
        setCoin(event.target.value); 
    }

    const handleSubmit = async (event) => {
        event.preventDefault();
        await api.post('/email', {
            email: email,
            coin: coin
        }).then(response => {
            setIsSubmitted(true);
        })
    }
    const openModal = () => {
        setShowModal(true);
      };
    
      const closeModal = () => {
        setShowModal(false);
      };
    
     
return (
        <>
            <Container className='main-card'>
            {showModal ? (
            <Modals Card={CardEmail} show={true} onClose={closeModal} />
          ) : (
            <CardInfo component={CardEmail} onClick={openModal} />
          )}
                <Container className='card-email'>
                    {!isSubmitted ? ( 
                          <Form onSubmit={handleSubmit}>
                          <Form.Group className='mb-3' controlId='formBasicEmail'>
                              <Form.Label style={{color:'white'}}>Email address</Form.Label>
                              <Form.Control type='email' placeholder='Enter email' onChange={emailForm}/>
  
                              <Form.Label style={{color:'white'}}> Type Coin </Form.Label>
                              <Form.Select value={coin} onChange={coinForm}>
                                  <option>All</option>
                                  <option>Crypto</option>
                                  <option>Traditional</option>
                              </Form.Select>
                          </Form.Group>
                          <Button variant='primary' type='submit'>
                              Submit
                          </Button>
                      </Form>
                    ) : (
                        <h2 style={{color:'white'}}>Email successfully sent!</h2>
                    )}
                </Container>
            </Container>
        </>
    )
}

export default CardEmail;