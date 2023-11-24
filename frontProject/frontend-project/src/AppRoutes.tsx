import {BrowserRouter, Routes, Route} from "react-router-dom";
import {DefaultPage} from "./pages/default.tsx";


function AppRoutes() {
    return(
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<DefaultPage/>}/>
            </Routes>
        </BrowserRouter>
    )
}
export default AppRoutes;