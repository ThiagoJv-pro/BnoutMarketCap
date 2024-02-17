import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import Container from 'react-bootstrap/Container';
import NavbarBrand from 'react-bootstrap/NavbarBrand'
import NavbarToggle from 'react-bootstrap/NavbarToggle'
import 'bootstrap/dist/css/bootstrap.min.css';
import './style.scss';

export function NavBar() 
{
    return(
    <Navbar>
        <Container>
            <NavbarBrand className='nav-style' href="#home">Bnout MarketCap</NavbarBrand>
        </Container>
    </Navbar> 
    )
}
export default NavBar;
