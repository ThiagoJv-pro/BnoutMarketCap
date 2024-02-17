import 'bootstrap/dist/css/bootstrap.min.css';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Card from 'react-bootstrap/Card';
import Converter from './CardConverter/Converter.tsx';
import News from './CardNews/News.tsx';
import CardList from './CardList/CardList.tsx';
import CardEmail from './CardEmail/CardEmail.tsx';
import Analytics from './CardAnalytics/Analytics.tsx';


export function CentralCard() {
    return (
        <Container style={{
            backgroundColor: "transparent",
            padding: "0",
            margin: "50px auto",
            width: "100%",
            height: "100%",
            borderRadius: "10px"
        }}>
            <Container style={{ backgroundColor: "transparent" }}>
            <Row>
                <Col>
                <Container style={{
                    marginTop: "10px",
                    padding: "10px",
                    borderRadius: "10px",
                    marginRight: "0",
                    height: "50vh",
                    backgroundColor: "transparent",
                }}>
                    <Converter />
                    <CardList />
                    {/* CRIAR OUTRO CONTAINER */}
                </Container>
                </Col>
                <Col>
                <Container style={{
                    marginTop: "10px",
                    padding: "10px",
                    borderRadius: "10px",
                    marginRight: "0",
                    height: "50vh",
                    backgroundColor: "transparent",
                }}>
                    {/* Analytics */}
                    <Analytics />
                    {/* Analytics */}
                </Container>
                </Col>
            </Row>
            </Container>
    
            <Container style={{ backgroundColor: "transparent" }}>
            <News />
            </Container>
    
            <Container style={{ backgroundColor: "transparent" }}>
            <CardEmail />
            </Container>
        </Container>
    );
  }
