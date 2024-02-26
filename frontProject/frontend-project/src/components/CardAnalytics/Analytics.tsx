import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Dropdown from 'react-bootstrap/Dropdown';
import Button from 'react-bootstrap/Button';
import { TfiReload } from 'react-icons/tfi';
import api from '../../api/dataapi.tsx';
import ChartC from '../Chart/Chart.tsx';
import Modals from '../Modal/Modal.tsx';
import CardInfo from '../CardInfo/CardInfo.tsx';
import AnalyticsService from './analytics.service.ts';

import './style.scss';

const Analytics = () => {

  const analyticsService = new AnalyticsService();

  const [data, setData] = useState(null);
  const [currencyFrom, setCurrencyFrom] = useState(null);
  const [currencyTo, setCurrencyTo] = useState(null);
  const [symbolTo, setSymbolTo] = useState(null);
  const [symbolFrom, setSymbolFrom] = useState('BTC');
  const [priceFrom, setPriceFrom] = useState(null);
  const [priceTo, setPriceTo] = useState(null);
  const [showModal, setShowModal] = useState(false);

  useEffect(() => {
      analyticsService.getCoins().then(coinsData => {
      setData(coinsData);
    }).catch(error => {
      console.error(error);
    });
  }, []);

  const updateChart = async () => {
    await api.get('/chart/update');
  };

  const openModal = () => {
    setShowModal(true);
  };

  const closeModal = () => {
    setShowModal(false);
  };

  const selectItemFrom = (name, price, symbol) => {
    setCurrencyFrom(name);
    setPriceFrom(price);
    setSymbolFrom(symbol);
  };

  const selectItemTo = (name, price, symbol) => {
    setCurrencyTo(name);
    setPriceTo(price);
    setSymbolTo(symbol);
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
            style={{ border: 'hidden', color: '#14FFEC' }}
            variant='outline-secondary'
            id='dropdown-basic'>
            {currencyFrom}
          </Dropdown.Toggle>

          <Dropdown.Menu className='dropdown-menu-chart'>
            {data?.map((result) => (
              <Dropdown.Item
                style={{ color: 'white' }}
                key={result.symbol}
                onClick={() => selectItemFrom(result.name, result.Price, result.symbol)}>
                {result.symbol} - {result.name}
              </Dropdown.Item>
            ))}
          </Dropdown.Menu>
          <Button className='reload-button' label='Reload Button' onClick={() => updateChart()}>
            <i><TfiReload /></i>
          </Button>
        </Dropdown>

        <ChartC cryptoCurrency={symbolFrom} />
      </Container>
    </>
  );
};

export default Analytics;
