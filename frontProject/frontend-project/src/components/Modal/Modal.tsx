import React, { useState } from 'react';
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';

const Modals = ({ Card, show, onClose }) => {
  const [showCard, setShowCard] = useState(show);

  const handleClose = () => {
    setShowCard(false);
    onClose(); 
  };


  return (
    <Modal 
          show={showCard} 
          onHide={handleClose} 
          backdrop="static" 
          size="lg" 
          aria-labelledby="contained-modal-title-vcenter"
          centered
          >
      <Modal.Header closeButton>
        <Modal.Title>{Card.name}</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Card />
      </Modal.Body>
    </Modal>
  );
};

export default Modals;