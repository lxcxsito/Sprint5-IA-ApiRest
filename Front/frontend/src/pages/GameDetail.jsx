import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { getGameById } from "../services/games";

export default function GameDetail() {
  const { id } = useParams();

  const [game, setGame] = useState(null);

  useEffect(() => {
    const fetchGame = async () => {
      try {
        const data = await getGameById(id);
        setGame(data);
      } catch (error) {
        console.error("Error cargando juego", error);
      }
    };

    fetchGame();
  }, [id]);

  if (!game) return <p>Cargando...</p>;

  return (
    <div>
      <h1>{game.title}</h1>

      <img src={game.urlImage} alt={game.title} width="300" />

      <p>{game.description}</p>

      <p>Precio: {game.price} €</p>

      <p>Categoría: {game.category?.name}</p>
    </div>
  );
}