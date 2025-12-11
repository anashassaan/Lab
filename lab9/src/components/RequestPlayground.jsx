import { useState } from 'react'
import { createDemoPost, deleteDemoPost, updateDemoPost } from '../services/requestClient'

const initialPost = {
  title: 'Pitch a new segment',
  body: 'Write a quick blurb describing why this story deserves a spotlight.',
}

const initialPut = {
  id: '1',
  title: 'Update story #1',
  body: 'Swap in a refreshed headline or summary to see PUT in action.',
}

const initialDelete = {
  id: '1',
}

function RequestPlayground() {
  const [postForm, setPostForm] = useState(initialPost)
  const [putForm, setPutForm] = useState(initialPut)
  const [deleteForm, setDeleteForm] = useState(initialDelete)
  const [busyAction, setBusyAction] = useState('')
  const [log, setLog] = useState([])

  const disabled = Boolean(busyAction)

  const pushLog = (entry) => {
    setLog((prev) => [entry, ...prev].slice(0, 6))
  }

  const runRequest = async (method, task) => {
    setBusyAction(method)
    try {
      const { status, data, latency } = await task()
      pushLog({
        method,
        ok: true,
        status,
        payload: data,
        latency,
        timestamp: new Date().toISOString(),
      })
    } catch (error) {
      pushLog({
        method,
        ok: false,
        status: error?.response?.status ?? 'Network',
        payload: error?.response?.data ?? error.message,
        latency: null,
        timestamp: new Date().toISOString(),
      })
    } finally {
      setBusyAction('')
    }
  }

  const handlePost = (event) => {
    event.preventDefault()
    runRequest('POST', () => createDemoPost(postForm))
  }

  const handlePut = (event) => {
    event.preventDefault()
    runRequest('PUT', () => updateDemoPost(putForm.id, { title: putForm.title, body: putForm.body }))
  }

  const handleDelete = (event) => {
    event.preventDefault()
    runRequest('DELETE', () => deleteDemoPost(deleteForm.id))
  }

  return (
    <section className="request-playground">
      <div className="request-grid">
        <article className="request-card">
          <h3>POST /posts</h3>
          <p>Create a brand new resource.</p>
          <form onSubmit={handlePost}>
            <label htmlFor="post-title">Title</label>
            <input
              id="post-title"
              value={postForm.title}
              onChange={(event) => setPostForm((prev) => ({ ...prev, title: event.target.value }))}
              required
            />
            <label htmlFor="post-body">Body</label>
            <textarea
              id="post-body"
              value={postForm.body}
              onChange={(event) => setPostForm((prev) => ({ ...prev, body: event.target.value }))}
              required
            />
            <button type="submit" disabled={disabled}>
              {busyAction === 'POST' ? 'Sending...' : 'Send POST'}
            </button>
          </form>
        </article>

        <article className="request-card">
          <h3>PUT /posts/{putForm.id || 'id'}</h3>
          <p>Overwrite an existing resource.</p>
          <form onSubmit={handlePut}>
            <label htmlFor="put-id">Post ID</label>
            <input
              id="put-id"
              type="number"
              min="1"
              value={putForm.id}
              onChange={(event) => setPutForm((prev) => ({ ...prev, id: event.target.value }))}
              required
            />
            <label htmlFor="put-title">Title</label>
            <input
              id="put-title"
              value={putForm.title}
              onChange={(event) => setPutForm((prev) => ({ ...prev, title: event.target.value }))}
              required
            />
            <label htmlFor="put-body">Body</label>
            <textarea
              id="put-body"
              value={putForm.body}
              onChange={(event) => setPutForm((prev) => ({ ...prev, body: event.target.value }))}
              required
            />
            <button type="submit" disabled={disabled}>
              {busyAction === 'PUT' ? 'Updating...' : 'Send PUT'}
            </button>
          </form>
        </article>

        <article className="request-card">
          <h3>DELETE /posts/{deleteForm.id || 'id'}</h3>
          <p>Remove a resource by id.</p>
          <form onSubmit={handleDelete}>
            <label htmlFor="delete-id">Post ID</label>
            <input
              id="delete-id"
              type="number"
              min="1"
              value={deleteForm.id}
              onChange={(event) => setDeleteForm({ id: event.target.value })}
              required
            />
            <button type="submit" disabled={disabled}>
              {busyAction === 'DELETE' ? 'Deleting...' : 'Send DELETE'}
            </button>
          </form>
        </article>
      </div>

      <div className="request-log">
        <h4>Live responses</h4>
        {log.length === 0 ? (
          <p className="status-message">No traffic yet. Trigger a request to populate the log.</p>
        ) : (
          <ul className="log-list">
            {log.map((entry, index) => (
              <li key={`${entry.timestamp}-${index}`} className="log-entry">
                <strong>{entry.method}</strong>
                <span className={`badge ${entry.ok ? 'ok' : 'error'}`}>
                  {entry.ok ? `${entry.status} OK` : entry.status}
                </span>
                <small>{new Date(entry.timestamp).toLocaleTimeString()}</small>
                <div>
                  <p>{typeof entry.payload === 'string' ? entry.payload : JSON.stringify(entry.payload)}</p>
                  {entry.latency && <small>{entry.latency} ms</small>}
                </div>
              </li>
            ))}
          </ul>
        )}
      </div>
    </section>
  )
}

export default RequestPlayground
