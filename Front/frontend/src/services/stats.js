import {api} from "./api";

export const getTopRatedGames = async () => {
  const response = await api.get("/games/top-rated");
  return response.data;
};

export const getMostSoldGames = async () => {
  const response = await api.get("/games/most-sold");
  return response.data;
};

export const getTopBuyers = async () => {
  const response = await api.get("/users/top-buyers");
  return response.data;
};