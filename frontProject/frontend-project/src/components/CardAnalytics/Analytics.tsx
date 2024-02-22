import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Dropdown from 'react-bootstrap/Dropdown';
import Card from 'react-bootstrap/Card';
import { FaExchangeAlt } from "react-icons/fa";
import api from '../../api/dataapi.tsx';
import ChartC from '../Chart/Chart.tsx';
import Modals from '../Modal/Modal.tsx';
import CardInfo from '../CardInfo/CardInfo.tsx';
import './style.scss';

const Analytics = () => {
  const [data, setData] = useState(null);
  const [currencyFrom, setCurrencyFrom] = useState(null);
  const [currencyTo, setCurrencyTo] = useState(null);
  const [symbolTo, setSymbolTo] = useState(null);
  const [symbolFrom, setSymbolFrom] = useState('BTC');
  const [priceFrom, setPriceFrom] = useState(null);
  const [priceTo, setPriceTo] = useState(null);
  const [showModal, setShowModal] = useState(false);

  const selectItemFrom = (name, price, symbol) => {
    setCurrencyFrom(name);
    setPriceFrom(price);
    setSymbolFrom(symbol);
  }

  const selectItemTo = (name, price, symbol) => {
    setCurrencyTo(name);
    setPriceTo(price);
    setSymbolTo(symbol);
  }

  const invertItems = () => {
    setCurrencyFrom(currencyTo);
    setCurrencyTo(currencyFrom);
    setPriceFrom(priceTo);
    setPriceTo(priceFrom);
  }

  const request = [];

  useEffect(() => {
    const getData = async () => {
      try {
        const response = await api.get('currency');
        setData(response.data);
      } catch (error) {
        console.error(error);
      }
    }

    getData();
  }, []);

  data?.forEach(element => {
    request.push(element);
  });

  const openModal = () => {
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
  };

  return (
    <>
      {showModal ? (
        <Modals Card={Analytics} show={true} onClose={closeModal} />
      ) : (
        <CardInfo component={Analytics} onClick={openModal} />
      )}

      <Container className='card-main-chart'>
        <Dropdown>
          <Dropdown.Toggle
            style={{ border: "hidden", color: "#14FFEC" }}
            variant="outline-secondary"
            id="dropdown-basic">
            {currencyFrom}
          </Dropdown.Toggle>

          <Dropdown.Menu className='dropdown-menu-chart'>
            {data?.map(result =>
              <Dropdown.Item style={{ color: "white" }}
                key={result.symbol}
                onClick={() => selectItemFrom(result.name, result.Price, result.symbol)}>
                {result.symbol} - {result.name}
              </Dropdown.Item>
            )}
          </Dropdown.Menu>
        </Dropdown>

        <ChartC cryptoCurrency={symbolFrom} />
      </Container>
    </>
  );
}

export default Analytics;
