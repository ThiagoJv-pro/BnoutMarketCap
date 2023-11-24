import {useMemo, useState, useEffect} from "react";
import axios from "axios";
   
const api = axios.create({
      baseURL: 'http://127.0.0.1:40787',
      
});

export default api;