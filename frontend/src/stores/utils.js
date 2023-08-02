export function checkCookie(name, value) {
  const cookie = document.cookie.split('; ').find((row) => row.startsWith(name))
  if (cookie !== `${name}=${value}`) {
    document.cookie = `${name}=${value}; max-age=0`
    setTimeout(() => {
      checkCookie(name, value)
    }, 100)
  }
}
