import './App.css';
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from "./pages/Login";
import Register from "./pages/Register";
import GameList from './pages/GameList';
import GameDetail from './pages/GameDetail';
import MyGames from './pages/MyGames';
function App() {
  return (
     <Router>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/games" element={<GameList />} />
        <Route path="/games/:id" element={<GameDetail />} />
        <Route path="/my-games" element={<MyGames />} />
      </Routes>
    </Router>
  );
}

export default App;