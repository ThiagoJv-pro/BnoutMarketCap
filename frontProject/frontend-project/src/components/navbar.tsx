import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import Container from 'react-bootstrap/Container';
import NavbarBrand from 'react-bootstrap/NavbarBrand'
import NavbarToggle from 'react-bootstrap/NavbarToggle'
import 'bootstrap/dist/css/bootstrap.min.css';

export function NavBar() 
{
    const style={color: 'white'}
    return(
    <Navbar>
        <Container>
            <NavbarBrand href="#home" style={style}>Bnout MarketCap</NavbarBrand>
        </Container>
    </Navbar> 
    )
}
export default NavBar;
