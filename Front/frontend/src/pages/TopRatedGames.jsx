import { useEffect, useState } from "react";
import { getTopRatedGames } from "../services/stats";

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
    <div>
      <h1>Juegos mejor valorados</h1>

      {games.map((game) => (
        <div key={game.id}>
          <h3>{game.title}</h3>
          <p>Rating: {game.reviews_avg_rating}</p>
        </div>
      ))}
    </div>
  );
}