import { Link } from "react-router-dom";
import "./GameCard.css";
export default function GameCard({ game }) {
  return (
    <div className="game-card">
      <img src={game.urlImage} alt={game.title} width="200" />

      <h3>{game.title}</h3>

      <p>{game.category?.name}</p>

      <p>{game.price} €</p>

      <Link to={`/games/${game.id}`}>
        <button>Ver detalles</button>
      </Link>
    </div>
  );
}