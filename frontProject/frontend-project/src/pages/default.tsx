import {News} from "../components/marquee.tsx";
import {NavBar} from "../components/navbar.tsx";
import {CentralCard} from "../components/centralCard.tsx";
import {LeftCard} from "../components/leftCard.tsx";
import {ChartCard} from "../components/chartCard.tsx";

import Container from 'react-bootstrap/Container';


export function DefaultPage(){
    return(
        <>
        <Container style={{margin: "10px auto"}}>
            <NavBar/>
            <News/>

           <CentralCard/>
           </Container>
        </>
    )
}