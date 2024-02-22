import './style.scss';
import Container from 'react-bootstrap/Container';


const CardInfo = ({component, onClick, activeCard = true}) => {

    return (
        <>
            {activeCard ? (
                <Container className='card-info' onClick={onClick}>
                    <span className='title'>{component.name}</span>
                </Container>) : <h1>.</h1>
            }
        </>  
    )
}

export default CardInfo;