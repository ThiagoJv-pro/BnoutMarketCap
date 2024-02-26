import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import Container from 'react-bootstrap/Container';
import NavbarBrand from 'react-bootstrap/NavbarBrand';
import NavbarToggle from 'react-bootstrap/NavbarToggle';
import Col from 'react-bootstrap/Col';
import Row from 'react-bootstrap/Row';
import {useEffect, useState} from 'react';
import NavBarService from './navbar.service.ts';
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.scss';

export function NavBar() 
{
    const [favorite, setFavorite] = useState(null);

    useEffect(() => {
        const getFavoriteCoin =  async () => {
            const navBarService = new NavBarService();
            navBarService.getFavoriteCoins()
            .then( coins => {
                setFavorite(coins);
            }).catch((error) => error)
        }
        getFavoriteCoin()
    }, []);

    return(
    <Navbar>
        <Container>
            <NavbarBrand className='nav-style' href="#home">Bnout MarketCap</NavbarBrand>
                <Row>
                    {
                        favorite?.map((coin) => (
                            <Col key={coin.symbol}>
                                <p className='color-text-symbol'>
                                {coin.symbol} 
                                </p>
                                <p className='color-text-price'>
                                ${coin.Price}
                                </p>
                            </Col>
                        ))
                    }
                </Row>
        </Container>
    </Navbar> 
    )
}
export default NavBar;
