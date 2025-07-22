import useSWR from 'swr'

const fetcher = (url: string) => fetch(url).then(r => r.json())

export default function Home() {
  const { data } = useSWR('/api/posts', fetcher)
  if (!data) return <p>Loading...</p>
  return (
    <div className="p-4 space-y-4">
      {data.map((p: any) => (
        <div key={p.id} className="border p-2">
          <h2 className="font-bold">{p.title}</h2>
          <p>{p.reply}</p>
        </div>
      ))}
    </div>
  )
}
