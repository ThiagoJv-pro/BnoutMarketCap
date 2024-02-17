import { useEffect, useState } from 'react';
import api from "../../api/dataapi.tsx";
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from "react-icons/fa";
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css'; // requires a loader
import './style.scss';

const News = () => {

    var [data, setData] = useState(null);

    useEffect(() => {
        const getData = async () => {
            await api.get('news')
                .then(response => {
                    setData(response.data)
                })
        }
        getData();
    }, []);

    return (
        <Container className='main-card'>
            <Container className='card-info' onClick={'teste'}>
                <span className='title'>News</span>
            </Container>
            <Container className='card-news'>
                <Carousel showIndicators={false} autoPlay={true} emulateTouch={true} infiniteLoop={true} axis={'horizontal'} showThumbs={false}>
                    {data?.map((result, index) => (
                        <Col key={index}>
                            <Card className='init-card'>
                                <Card.Img variant="top"
                                    src={result.BannerImage}
                                    style={{ height: '50vh' }} />
                                <Card.Body>
                                    <Card.Title style={{
                                        color: "#14FFEC",
                                    }}>
                                        {result.Title}
                                    </Card.Title>
                                    <Card.Text className='card-text'>
                                        {result.Summary}
                                    </Card.Text>
                                    <h9 style={{
                                        color: "white"
                                    }}>...</h9>
                                </Card.Body>
                            </Card>
                        </Col>
                    ))}
                </Carousel>
            </Container>
        </Container>
    );
};

export default News;
