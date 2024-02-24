import React, { useEffect, useState } from 'react';
import api from '../../api/dataapi.tsx';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';
import Card from 'react-bootstrap/Card';
import CardInfo from '../CardInfo/CardInfo.tsx';
import Modals from '../Modal/Modal.tsx';
import './style.scss';

const News = () => {
  const [data, setData] = useState(null);
  const [showModal, setShowModal] = useState(false);

  useEffect(() => {
    const getData = async () => {
      try {
        const response = await api.get('news');
        setData(response.data);
      } catch (error) {
        console.error(error);
      }
    };

    getData();
  }, []);

  const openModal = () => {
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
  };

  return (
    <Container className='main-card'>
      {showModal ? (
        <Modals Card={News} show={true} onClose={closeModal} />
      ) : (
        <CardInfo component={News} onClick={openModal} />
      )}

      <Container className='card-news'>
        <Carousel
          showIndicators={false}
          autoPlay
          emulateTouch
          infiniteLoop
          axis={'horizontal'}
          showThumbs={false}
        >
          {data?.map((result, index) => (
            <a href={result.URL} target='_blank' key={index}>
              <Card className='init-card'>
                <Card.Img variant="top" src={result.BannerImage} style={{ height: '50vh' }} />
                <Card.Body>
                  <Card.Title style={{ color: '#14FFEC' }}>{result.Title}</Card.Title>
                  <Card.Text className='card-text'>{result.Summary}</Card.Text>
                  <h9 style={{ color: 'white' }}>...</h9>
                </Card.Body>
              </Card>
            </a>
          ))}
        </Carousel>
      </Container>
    </Container>
  );
};

export default News;
