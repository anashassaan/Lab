# Pulsewire News Lab

A React + Vite lab where students consume the News API for real GET requests and practice POST / PUT / DELETE calls through a request playground. The layout is tuned for clean, responsive storytelling on both desktop and mobile.

## Features

- **Live headlines** powered by [`newsapi.org`](https://newsapi.org). Students can swap countries and categories, then issue a GET refresh on demand.
- **Request Lab** hits [`jsonplaceholder.typicode.com`](https://jsonplaceholder.typicode.com) so that POST, PUT, and DELETE calls mutate safe mock data while still travelling across the network.
- **Request logging** surfaces verb, status code, timestamp, and latency for each practice request.
- **Responsive UI** with a custom hero, filter chips, and card grid that adapts across screen sizes.

## Getting Started

```bash
npm install            # install dependencies
cp .env.example .env   # add your News API key
npm run dev            # start Vite on http://localhost:5173
```

### Configure the News API

1. Create a free account at [newsapi.org](https://newsapi.org/).
2. Copy your key and update `.env`:

	```bash
	VITE_NEWS_API_KEY=your-key-here
	```

3. Restart `npm run dev` so Vite picks up the new variable.

If a key is missing, the UI gracefully falls back to the bundled sample dataset so the interface stays functional during demos.

### Practicing POST / PUT / DELETE

- The playground panel sends real HTTP requests to `https://jsonplaceholder.typicode.com/posts` using Axios.
- All handlers live in `src/services/requestClient.js`. Feel free to swap the base URL for your own backend when you are ready.

## Scripts

| Command         | Description                              |
| --------------- | ---------------------------------------- |
| `npm run dev`   | Start the Vite development server        |
| `npm run build` | Create a production build in `dist/`     |
| `npm run preview` | Serve the production build locally     |
| `npm run lint`  | Run ESLint across the project            |

## Deploying to GitHub Pages

1. Build the site: `npm run build`
2. Commit the generated `dist` folder.
3. Push to GitHub.
4. Either:
	- Configure **Settings → Pages → Deploy from GitHub Actions** using the "Vite" workflow, **or**
	- Push the `dist` folder to a `gh-pages` branch with `git subtree push --prefix dist origin gh-pages`.
5. Share the `https://<username>.github.io/<repo>/` link with your instructor.

> Tip: If the repository is not at the root of your GitHub Pages domain, update `vite.config.js` with the correct `base` path before building.

## Folder Highlights

- `src/components` houses the Hero, FiltersBar, NewsGrid, and RequestPlayground UI building blocks.
- `src/hooks/useNewsFeed.js` centralizes the GET workflow, including loading and error states.
- `src/services/newsApi.js` and `src/services/requestClient.js` wrap Axios so the rest of the app stays declarative.

Feel free to extend the lab with authentication, pagination, or a real backend once the core exercises are complete.
