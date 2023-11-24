import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'




export function LeftCard(){
    return(
        <Container style={{backgroundColor:"white", marginLeft: "0px auto", rightLeft: "50px" }}>

           <Container>
                <Row style={{backgroundColor:"blue", marginTop: "10px"}}>
                    teste
                </Row>
                <Row style={{backgroundColor:"blue", marginTop: "10px"}} >
                    teste
                </Row>
           </Container>

        </Container>
    )
}