import { useEffect, useState } from "react";
import { getTopRatedGames } from "../services/stats";
import "./Stats.css";

export default function TopRatedGames() {
  const [games, setGames] = useState([]);

  useEffect(() => {
    const fetchGames = async () => {
      try {
        const data = await getTopRatedGames();
        setGames(data);
      } catch (error) {
        console.error("Error cargando top rated", error);
      }
    };

    fetchGames();
  }, []);

  return (
    <div className="stats-container">

      <h1>⭐ Juegos mejor valorados</h1>

      <div className="stats-list">

        {games.map((game, index) => (
          <div className="stats-card" key={game.id}>

            <div className="stats-info">
              <span className="stats-title">
                #{index + 1} {game.title}
              </span>
              <span className="stats-sub">Rating medio</span>
            </div>

            <span className="stats-value">
              ⭐ {Number(game.reviews_avg_rating).toFixed(1)}
            </span>

          </div>
        ))}

      </div>
    </div>
  );
}