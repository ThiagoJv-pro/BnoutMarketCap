import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import ListGroup from 'react-bootstrap/ListGroup';
import { useEffect, useState } from 'react';
import api from '../../api/dataapi.tsx';
import './style.scss';

const CardList = () => {
  const [typeCoin, setTypeCoin] = useState(null);
  const [data, setData] = useState(null);
  const [data2, setData2] = useState(null);
  const [stateToggle, setStateToggle] = useState(null);

  useEffect(() => {
    const getData = async () => {
      try {
        const response = await api.get('/listCoin', {
          params: {
            currency: 'c',
          },
        });
        setData(response.data);
      } catch (error) {
        console.error(error);
      }
    };
    getData();
  }, []);

  useEffect(() => {
    const getData2 = async () => {
      try {
        const response = await api.get('/listCoin', {
          params: {
            currency: 't',
          },
        });
        setData2(response.data);
      } catch (error) {
        console.error(error);
      }
    };
    getData2();
  }, []);

  return (
    <>
      <Row>
        <Col>
          <Container className='card-main'>
            <Container className='card-list '>
              <ListGroup>
                {data?.map((result) => (
                  <ListGroup.Item action className='list' key={result.symbol}>
                    <p className='coins'>
                      {result.symbol} | ${result.Price}
                    </p>
                    <p className='coins'>{result.name}</p>
                  </ListGroup.Item>
                ))}
              </ListGroup>
            </Container>
          </Container>
        </Col>
        <Col>
          <Container className='card-main'>
            <Container className='card-list'>
              <ListGroup className='list-group-list'>
                {data2?.map((result) => (
                  <ListGroup.Item action className='list' key={result.symbol}>
                    <p className='coins'>
                      {result.symbol} | ${result.Price}
                    </p>
                    <p className='coins'>{result.name}</p>
                  </ListGroup.Item>
                ))}
              </ListGroup>
            </Container>
          </Container>
        </Col>
      </Row>
    </>
  );
};

export default CardList;
