import { useEffect, useState } from "react";
import { getGames } from "../services/games";
import GameCard from "../components/GameCard";
import "./Home.css";

export default function Home() {

  const [games, setGames] = useState([]);

  useEffect(() => {

    const fetchGames = async () => {
      const data = await getGames();
      setGames(data.slice(0,4));
    };

    fetchGames();

  }, []);

  return (
    <div className="home">

      <section className="hero">

        <h1>GameStore</h1>

        <p>Compra tus videojuegos favoritos al mejor precio</p>

      </section>

      <section className="featured">

        <h2>Juegos destacados</h2>

        <div className="games-grid">

          {games.map(game => (
            <GameCard key={game.id} game={game}/>
          ))}

        </div>

      </section>

    </div>
  );
}