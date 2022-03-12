export async function store() {
  try {
    const { data } = await (
      await fetch("http://0.0.0.0:8000/api/v1/seasons", { method: "POST" })
    ).json();

    return { data };
  } catch (error) {
    return { error };
  }
}

export async function show(id) {
  try {
    const { data } = await (
      await fetch(`http://0.0.0.0:8000/api/v1/seasons/${id}`, { method: "GET" })
    ).json();

    return { data };
  } catch (error) {
    return { error };
  }
}
