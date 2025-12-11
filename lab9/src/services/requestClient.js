import axios from 'axios'

const requestClient = axios.create({
  baseURL: 'https://jsonplaceholder.typicode.com',
  headers: {
    'Content-Type': 'application/json; charset=UTF-8',
  },
  timeout: 8000,
})

async function timedRequest(promise) {
  const start = performance.now()
  const response = await promise
  return {
    status: response.status,
    data: response.data,
    latency: Math.round(performance.now() - start),
  }
}

export function createDemoPost(payload) {
  return timedRequest(requestClient.post('/posts', payload))
}

export function updateDemoPost(id, payload) {
  return timedRequest(requestClient.put(`/posts/${id}`, payload))
}

export function deleteDemoPost(id) {
  return timedRequest(requestClient.delete(`/posts/${id}`))
}
