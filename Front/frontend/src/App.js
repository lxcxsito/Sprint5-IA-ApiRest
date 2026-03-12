import './App.css';
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from "./pages/Login";
import Register from "./pages/Register";
import GameList from './pages/GameList';
import GameDetail from './pages/GameDetail';
import MyGames from './pages/MyGames';
import TopRatedGames from "./pages/TopRatedGames";
import MostSoldGames from "./pages/MostSoldGames";
import TopBuyers from "./pages/TopBuyers";
import AdminGames from "./pages/AdminGames";
import AdminPurchases from "./pages/AdminPurchases";
import Home from './pages/Home';
function App() {
  return (
     <Router> 
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/games" element={<GameList />} />
        <Route path="/games/:id" element={<GameDetail />} />
        <Route path="/my-games" element={<MyGames />} />
        <Route path="/stats/top-rated" element={<TopRatedGames />} />
        <Route path="/stats/most-sold" element={<MostSoldGames />} />
        <Route path="/stats/top-buyers" element={<TopBuyers />} />  
        <Route path="/admin/games" element={<AdminGames />} />
        <Route path="/admin/purchases" element={<AdminPurchases />} />
        <Route path="/" element={<Home />} />
      </Routes>
    </Router>
  );  
}

export default App;