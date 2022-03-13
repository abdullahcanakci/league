
// eslint-disable-next-line no-undef
const APP_URL = import.meta.env.VITE_API_URL;

export async function store() {
  try {
    const { data } = await (
      await fetch(`${APP_URL}/seasons`, { method: "POST" })
    ).json();

    return { data };
  } catch (error) {
    return { error };
  }
}

export async function show(id) {
  try {
    const { data } = await (
      await fetch(`${APP_URL}/seasons/${id}`, { method: "GET" })
    ).json();

    return { data };
  } catch (error) {
    return { error };
  }
}

export async function play(id) {
  try {
    const { data } = await (
      await fetch(`${APP_URL}/seasons/${id}/play`, {
        method: "POST",
      })
    ).json();

    return { data };
  } catch (error) {
    return { error };
  }
}
