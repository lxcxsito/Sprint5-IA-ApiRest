import { useEffect, useState } from "react";
import { getMyGames } from "../services/purchases";

export default function MyGames() {
  const [games, setGames] = useState([]);

  useEffect(() => {
    const fetchGames = async () => {
      try {
        const data = await getMyGames();
        setGames(data);
      } catch (error) {
        console.error("Error cargando biblioteca", error);
      }
    };

    fetchGames();
  }, []);

  return (
    <div>
      <h1>Mi biblioteca</h1>

      {games.length === 0 && <p>No tienes juegos comprados.</p>}

      {games.map((game) => (
        <div key={game.id}>
          <h3>{game.title}</h3>
          <p>{game.price} €</p>
        </div>
      ))}
    </div>
  );
}