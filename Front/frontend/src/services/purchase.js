import { api } from "./api";

export const purchaseGame = async (gameId) => {
  const res = await api.post(`/purchases/${gameId}`);
  return res.data;
};

export const myGames = async () => {
  const res = await api.get("/my-games");
  return res.data;
};