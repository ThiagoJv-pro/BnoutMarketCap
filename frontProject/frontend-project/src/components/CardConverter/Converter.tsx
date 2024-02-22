import React, { useEffect, useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from "react-icons/fa";
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import api from "../../api/dataapi.tsx";
import Modals from '../Modal/Modal.tsx';
import CardInfo from '../CardInfo/CardInfo.tsx';
import './style.scss';

const Converter = () => {
  const [data, setData] = useState([]);
  const [converter, setConverter] = useState(0.1);
  const [currencyFrom, setCurrencyFrom] = useState(null);
  const [currencyTo, setCurrencyTo] = useState(null);
  const [symbolTo, setSymbolTo] = useState(null);
  const [symbolFrom, setSymbolFrom] = useState(null);
  const [priceFrom, setPriceFrom] = useState(1);
  const [priceTo, setPriceTo] = useState(1);
  const [inverter, setInverter] = useState(false);
  const [showModal, setShowModal] = useState(false);

  const fetchData = async () => {
    try {
      const response = await api.get('currency');
      setData(response.data || []);
    } catch (error) {
      console.error(error);
    }
  };

  const fetchConverterData = async () => {
    try {
      const response = await api.get('/converter', {
        params: {
          fromPrice: priceFrom,
          toPrice: priceTo,
          inverter: inverter
        }
      });
      setConverter(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);

  useEffect(() => {
    fetchConverterData();
  }, [priceFrom, priceTo, inverter]);

  const selectItem = (name, price, symbol, isFrom) => {
    const priceFormatter = price.toFixed(2);
    isFrom
      ? setCurrencyFrom(name)
      : setCurrencyTo(name);
    isFrom
      ? setSymbolFrom(symbol)
      : setSymbolTo(symbol);
    isFrom
      ? setPriceFrom(priceFormatter)
      : setPriceTo(priceFormatter);
  };

  const invertItems = () => {
    setCurrencyFrom(currencyTo);
    setCurrencyTo(currencyFrom);
    setPriceFrom(priceTo);
    setPriceTo(priceFrom);
    setInverter(true);
  };

  const openModal = () => {
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
  };

  return (
    <>
      {showModal ? (
        <Modals Card={Converter} show={true} onClose={closeModal} />
      ) : (
        <CardInfo component={Converter} onClick={openModal} />
      )}

      <Container className='card-main'>
        <Row>
          <Col>
            <h9 style={{ color: "white" }}>De:</h9>
            <Card className='card-converter'>
              <Card.Body style={{ padding: "0" }}>
                <Dropdown>
                  <Dropdown.Toggle
                    style={{ border: "hidden", color: "white" }}
                    variant="outline-secondary"
                    id="dropdown-basic"
                  >
                    {currencyFrom}
                  </Dropdown.Toggle>
                  <Dropdown.Menu className='dropdown-menu-converter'>
                    {data.map(result => (
                      <Dropdown.Item
                        key={result.name}
                        className='dropdown-item-converter'
                        onClick={() => selectItem(result.name, result.Price, result.symbol, true)}>
                        {result.symbol} - {result.name}
                      </Dropdown.Item>
                    ))}
                  </Dropdown.Menu>
                </Dropdown>
                <Container style={{ height: "10vh", marginTop: "5%" }}>
                  <h9 style={{ color: "white" }}>R$ {priceFrom}</h9>
                </Container>
              </Card.Body>
            </Card>
          </Col>
          <Col md="auto" style={{ textAlign: "center" }}>
            <div style={{ marginTop: "150%" }}>
              <Button className='converter-button' onClick={invertItems}>
                <i><FaExchangeAlt style={{ color: "#14FFEC" }} /></i>
              </Button>
            </div>
          </Col>
          <Col>
            <h9 style={{ color: "white" }}>Para:</h9>
            <Card className='card-converter'>
              <Card.Body style={{ padding: "0" }}>
                <Dropdown>
                  <Dropdown.Toggle
                    style={{ border: "hidden", color: "white" }}
                    variant="outline-secondary"
                    id="dropdown-basic"
                  >
                    {currencyTo}
                  </Dropdown.Toggle>
                  <Dropdown.Menu className='dropdown-menu-converter'>
                    {data.map(result => (
                      <Dropdown.Item
                        key={result.name}
                        className='dropdown-item-converter'
                        onClick={() => selectItem(result.name, result.Price, result.symbol, false)}>
                        {result.symbol} - {result.name}
                      </Dropdown.Item>
                    ))}
                  </Dropdown.Menu>
                </Dropdown>
                <Container style={{ height: "10vh", marginTop: "5%" }}>
                  <h9 style={{ color: "white" }}>R$ {priceTo}</h9>
                </Container>
              </Card.Body>
            </Card>
          </Col>
        </Row>
        <Container className='result-container'>
          <Container className='internal-result-container'>
            <h2 style={{ color: "#14FFEC" }}>{converter}</h2>
          </Container>
        </Container>
      </Container>
    </>
  );
};

export default Converter;
