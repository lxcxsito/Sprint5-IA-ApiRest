import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { getGameById } from "../services/games";
import PurchaseButton from "../components/PurchaseButton";
import "./GameDetail.css";
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
<div className="game-detail-container">
  <h1>{game.title}</h1>
  <img src={game.urlImage} alt={game.title} />
  <p>{game.description}</p>
  <p className="price">Precio: {game.price} €</p>
  <div className="purchase-button">
    <PurchaseButton gameId={game.id} />
  </div>
  <p>Categoría: {game.category?.name}</p>
</div>
  );
}