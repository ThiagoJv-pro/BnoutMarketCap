import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Dropdown from 'react-bootstrap/Dropdown';
import { FaExchangeAlt } from "react-icons/fa";
import Button from 'react-bootstrap/Button';
import Card from 'react-bootstrap/Card';
import { useEffect, useState } from 'react';
import api from "../../api/dataapi.tsx";
import DropdownButton from 'react-bootstrap/DropdownButton';
import './style.scss';

const Converter = () => {

  const request = [];
  
  let [data, setData] = useState(null);
  let [converter, setConverter] = useState(0.1);
  let [currencyFrom, setCurrencyFrom] = useState(null);
  let [currencyTo, setCurrencyTo] = useState(null);
  let [symbolTo, setSymbolTo] = useState(null);
  let [symbolFrom, setSymbolFrom] = useState(null);
  let [priceFrom, setPriceFrom] = useState(1);
  let [priceTo, setPriceTo] = useState(1);
  let [inverter, setInverter] = useState(false);

  const selectItemFrom = (name: string, price: float, symbol: string) => {
    let priceFormatter = price.toFixed(2);
    setCurrencyFrom(name);
    setPriceFrom(priceFormatter);
    setSymbolFrom(symbol);
  }

  const selectItemTo = (name: string, price: float, symbol: string) => {
    let priceFormatter = price.toFixed(2);
    setCurrencyTo(name);
    setPriceTo(priceFormatter);
    setSymbolTo(symbol);
  }

  const invertItems = () => {
    setCurrencyFrom(setCurrencyTo);
    setCurrencyTo(setCurrencyFrom);
    setPriceFrom(setPriceTo);
    setPriceTo(setPriceFrom);
    setInverter(true);
  }

  useEffect(() => {
    const getData = async () => {
      await api.get('currency')
        .then(response => {
          setData(response.data);
        });
    }
    getData();
  }, []);

  useEffect(() => {
    const getData = async () => {
      await api.get('/converter', {
        params: {
          fromPrice: priceFrom,
          toPrice: priceTo,
          inverter: inverter
        }
      })
      .then(response => {
        setConverter(response.data);
      });
    }
    getData();
  }, [priceFrom, priceTo, inverter]);

  data?.forEach(element => {
    request.push(element);
  });

  return (
    <>
      <Container className='card-info' onClick={'teste'}>
        <span className='title'>Converter</span>
      </Container>
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
                    {data?.map((result =>  
                      <Dropdown.Item className='dropdown-item-converter'
                        onClick={() => selectItemFrom(result.name, result.Price, result.symbol)}>
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
              <Button className='converter-button' onClick={() => invertItems()}>
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
                    {data?.map((result =>  
                      <Dropdown.Item className='dropdown-item-converter'
                        onClick={() => selectItemTo(result.name, result.Price, result.symbol)}>
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
}

export default Converter;
