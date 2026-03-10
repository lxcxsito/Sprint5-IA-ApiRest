import { api } from "./api";

export const login = async (email, password) => {
  const res = await api.post("/login", { email, password });
  localStorage.setItem("token", res.data.token);
  return res.data.user;
};

export const register = async (name, email, password) => {
  const res = await api.post("/register", { name, email, password });
  localStorage.setItem("token", res.data.token);
  return res.data.user;
};

export const logout = async () => {
  await api.post("/logout");
  localStorage.removeItem("token");
};

export const getUser = async () => {
  const res = await api.get("/user");
  return res.data;
};