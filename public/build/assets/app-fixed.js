const $ = selector => document.querySelector(selector)
const $$ = selector => document.querySelectorAll(selector)

function initTheme() {
  const saved = localStorage.getItem('rml-theme')
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches

  if (saved === 'dark' || (!saved && prefersDark)) {
    document.documentElement.classList.add('dark')
  }

  updateThemeButton()

  $('#theme-toggle')?.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark')
    localStorage.setItem(
      'rml-theme',
      document.documentElement.classList.contains('dark') ? 'dark' : 'light'
    )
    updateThemeButton()
  })
}

function updateThemeButton() {
  const button = $('#theme-toggle')
  if (!button) return
  button.textContent = document.documentElement.classList.contains('dark') ? '☀️ Day' : '🌙 Night'
}

function initMobileMenu() {
  $('#mobile-menu-toggle')?.addEventListener('click', () => {
    $('#mobile-menu')?.classList.toggle('hidden')
  })
}

function initPersonalization() {
  const name = localStorage.getItem('rml-name') || window.RML_CONFIG?.defaultName || 'Rozhi'

  $$('[data-rozhi]').forEach(el => {
    el.textContent = name
  })
}

function initStars() {
  const root = $('#star-field')
  if (!root) return

  for (let i = 0; i < 45; i++) {
    const star = document.createElement('span')
    star.className = 'star'
    star.style.top = `${Math.random() * 100}%`
    star.style.left = `${Math.random() * 100}%`
    star.style.animationDelay = `${Math.random() * 3}s`
    star.style.opacity = `${0.18 + Math.random() * 0.55}`
    root.appendChild(star)
  }
}

function initTimeline() {
  const items = $$('.timeline-item')
  if (!items.length) return

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('is-visible')
    })
  }, { threshold: 0.2 })

  items.forEach(item => observer.observe(item))
}

function initMemoryModal() {
  const modal = $('#memory-modal')
  if (!modal) return

  const title = $('#modal-title')
  const place = $('#modal-place')
  const desc = $('#modal-description')
  const image = $('#modal-image')
  const copyButton = $('#modal-copy')
  const copyStatus = $('#modal-copy-status')

  $$('.memory-card').forEach(card => {
    card.addEventListener('click', () => {
      title.textContent = card.dataset.title || ''
      place.textContent = card.dataset.place || ''
      desc.textContent = card.dataset.description || ''
      copyStatus?.classList.add('hidden')

      const img = card.dataset.image
      const fallback = window.RML_CONFIG?.catFallback || '/images/black-kitten.svg'
      image.innerHTML = img
        ? `<img src="${escapeAttribute(img)}" onerror="this.onerror=null;this.src='${escapeAttribute(fallback)}'" alt="" class="h-full w-full rounded-[2rem] object-cover">`
        : '🐾'

      modal.classList.add('is-open')
    })
  })

  copyButton?.addEventListener('click', async () => {
    const text = `${title.textContent}\n${place.textContent}\n${desc.textContent}`
    await copyToClipboard(text)
    copyStatus?.classList.remove('hidden')
  })

  $('#modal-close')?.addEventListener('click', () => modal.classList.remove('is-open'))

  modal.addEventListener('click', event => {
    if (event.target === modal) modal.classList.remove('is-open')
  })

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape') modal.classList.remove('is-open')
  })
}

function initVibeSpinner() {
  const button = $('#vibe-spin')
  const display = $('#vibe-spinner-display')
  const cards = [...$$('.spin-card')]
  if (!button || !display || !cards.length) return

  button.addEventListener('click', () => {
    const chosen = cards[Math.floor(Math.random() * cards.length)]
    const emoji = chosen.dataset.emoji || '☕'
    const title = chosen.dataset.title || 'Coffee Run'
    const text = chosen.dataset.text || 'یه پلن ساده انتخاب شد.'

    display.classList.remove('is-spinning')
    void display.offsetWidth
    display.classList.add('is-spinning')
    display.innerHTML = `
      <div class="text-7xl">${escapeHtml(emoji)}</div>
      <h2 class="mt-5 text-3xl font-black">${escapeHtml(title)}</h2>
      <p class="mx-auto mt-3 max-w-sm leading-8 text-cocoa/70 dark:text-white/70">${escapeHtml(text)}</p>
      <button class="copy-text secondary-button mt-5" type="button" data-copy="${escapeAttribute(text)}">کپی متن</button>
    `

    initCopyTextButtons(display)
  })
}

function initQuiz() {
  const root = $('#quiz-root')
  const resultBox = $('#quiz-result')
  const resultText = $('#quiz-result-text')
  const questions = window.RML_QUIZ || []

  if (!root || !questions.length) return

  let current = 0
  const answers = []

  function renderQuestion() {
    const question = questions[current]

    root.innerHTML = `
      <div class="glass-card p-6 md:p-8">
        <div class="mb-5 flex items-center justify-between gap-4">
          <span class="rounded-full bg-blush-100 px-4 py-2 text-sm font-black dark:bg-white/10">
            ${current + 1} / ${questions.length}
          </span>
          <span class="text-3xl">🐈‍⬛</span>
        </div>

        <h2 class="text-2xl font-black leading-10">${escapeHtml(question.question)}</h2>

        <div class="mt-6 grid gap-3">
          ${question.options.map((option, index) => `
            <label class="quiz-option">
              <input type="radio" name="quiz_option" value="${index}">
              <span>${escapeHtml(option.text)}</span>
            </label>
          `).join('')}
        </div>

        <button id="quiz-next" class="cute-button mt-7 w-full" type="button">
          ${current === questions.length - 1 ? 'دیدن پیشنهاد ✨' : 'بعدی'}
        </button>
      </div>
    `

    $('#quiz-next').addEventListener('click', () => {
      const selected = $('input[name="quiz_option"]:checked')
      if (!selected) {
        root.querySelector('.glass-card').classList.add('ring-4', 'ring-blush-200')
        return
      }

      const option = question.options[Number(selected.value)]
      answers.push(option.score || 0)

      if (current < questions.length - 1) {
        current++
        renderQuestion()
      } else {
        showResult()
      }
    })
  }

  function showResult() {
    const score = answers.reduce((sum, item) => sum + item, 0)

    let message = ''
    if (score >= 31) {
      message = 'پیشنهاد مناسب: رودتریپ کوتاه روزانه؛ مسیر سبک، برگشت همان روز، بعدش قهوه.'
    } else if (score >= 24) {
      message = 'پیشنهاد مناسب: گیتار زدن و بعد قهوه؛ وایب متفاوت‌تر و جمع‌وجور.'
    } else {
      message = 'پیشنهاد مناسب: قهوه کوتاه؛ ساده‌ترین شروع و کم‌حاشیه‌ترین انتخاب.'
    }

    root.innerHTML = ''
    resultText.textContent = message
    resultBox.classList.remove('hidden')
    launchConfetti()
  }

  renderQuestion()
}

function launchConfetti() {
  const canvas = $('#confetti-canvas')
  if (!canvas) return

  const ctx = canvas.getContext('2d')
  const pieces = []
  const colors = ['#f9a8c4', '#fecddf', '#d8c7ff', '#11101a']

  canvas.width = window.innerWidth
  canvas.height = window.innerHeight

  for (let i = 0; i < 90; i++) {
    pieces.push({
      x: Math.random() * canvas.width,
      y: -20 - Math.random() * canvas.height,
      size: 6 + Math.random() * 10,
      speed: 2 + Math.random() * 4,
      color: colors[Math.floor(Math.random() * colors.length)],
      rotate: Math.random() * 360,
    })
  }

  let frames = 0

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height)

    pieces.forEach(piece => {
      ctx.save()
      ctx.translate(piece.x, piece.y)
      ctx.rotate(piece.rotate)
      ctx.fillStyle = piece.color
      ctx.beginPath()
      ctx.arc(0, 0, piece.size / 2, 0, Math.PI * 2)
      ctx.fill()
      ctx.restore()

      piece.y += piece.speed
      piece.x += Math.sin(frames / 18)
      piece.rotate += 0.05
    })

    frames++

    if (frames < 150) requestAnimationFrame(draw)
    else ctx.clearRect(0, 0, canvas.width, canvas.height)
  }

  draw()
}

function initInviteCopy() {
  $('#copy-invite')?.addEventListener('click', async event => {
    const link = event.currentTarget.dataset.link
    await copyToClipboard(link)
    $('#copy-message')?.classList.remove('hidden')
  })

  initCopyTextButtons(document)
}

function initCopyTextButtons(root = document) {
  root.querySelectorAll('.copy-text').forEach(button => {
    if (button.dataset.copyReady === '1') return
    button.dataset.copyReady = '1'
    button.addEventListener('click', async event => {
      await copyToClipboard(event.currentTarget.dataset.copy || '')
      const previous = event.currentTarget.textContent
      event.currentTarget.textContent = 'کپی شد'
      setTimeout(() => {
        event.currentTarget.textContent = previous
      }, 1300)
    })
  })
}

async function copyToClipboard(value) {
  try {
    await navigator.clipboard.writeText(value)
  } catch {
    window.prompt('کپی کن:', value)
  }
}

function initBackgroundMusic() {
  if (window.__RML_AUDIO_INITIALIZED__) return
  window.__RML_AUDIO_INITIALIZED__ = true

  const audio = $('#bg-audio')
  const button = $('#music-toggle')
  const dock = $('.music-dock')
  const status = $('#music-status')

  if (!audio || !button || !dock || !status) return

  const tabId = `${Date.now()}-${Math.random().toString(16).slice(2)}`
  const ownerKey = 'rml-audio-owner'
  const lockTtl = 9500
  const heartbeatMs = 3000
  const channel = 'BroadcastChannel' in window ? new BroadcastChannel('rml-audio-sync') : null
  let lockTimer = null
  let manualPause = false

  audio.src = audio.dataset.src
  audio.volume = 0.38
  status.textContent = 'برای پخش روی ♫ بزن'

  function now() {
    return Date.now()
  }

  function readOwner() {
    try {
      const raw = localStorage.getItem(ownerKey)
      return raw ? JSON.parse(raw) : null
    } catch {
      return null
    }
  }

  function hasActiveOtherOwner() {
    const owner = readOwner()
    return owner && owner.tabId !== tabId && Number(owner.expiresAt || 0) > now()
  }

  function writeOwner() {
    try {
      localStorage.setItem(ownerKey, JSON.stringify({ tabId, expiresAt: now() + lockTtl }))
    } catch {}
  }

  function releaseOwner() {
    const owner = readOwner()
    if (owner?.tabId === tabId) {
      try { localStorage.removeItem(ownerKey) } catch {}
    }
    if (lockTimer) {
      clearInterval(lockTimer)
      lockTimer = null
    }
  }

  function startHeartbeat() {
    writeOwner()
    if (lockTimer) clearInterval(lockTimer)
    lockTimer = setInterval(() => {
      if (!audio.paused) writeOwner()
    }, heartbeatMs)
  }

  function setPausedUi(message = 'متوقف شد') {
    dock.classList.remove('is-playing')
    button.textContent = '♫'
    status.textContent = message
  }

  function setPlayingUi() {
    dock.classList.add('is-playing')
    button.textContent = '❚❚'
    status.textContent = 'در حال پخش'
  }

  function pauseBecauseAnotherSourceStarted() {
    if (!audio.paused) {
      manualPause = true
      audio.pause()
      manualPause = false
    }
    releaseOwner()
    setPausedUi('در یک صفحه دیگر در حال پخش است')
  }

  async function playHere() {
    if (hasActiveOtherOwner()) {
      setPausedUi('در یک صفحه دیگر در حال پخش است')
      return
    }

    startHeartbeat()
    channel?.postMessage({ type: 'rml-audio-started', tabId })

    try {
      await audio.play()
      setPlayingUi()
    } catch {
      releaseOwner()
      setPausedUi('برای پخش، یک بار روی ♫ بزن')
    }
  }

  function pauseHere(message = 'متوقف شد') {
    manualPause = true
    audio.pause()
    manualPause = false
    releaseOwner()
    channel?.postMessage({ type: 'rml-audio-paused', tabId })
    setPausedUi(message)
  }

  button.addEventListener('click', () => {
    if (audio.paused) playHere()
    else pauseHere()
  })

  audio.addEventListener('ended', () => releaseOwner())
  audio.addEventListener('pause', () => {
    if (!manualPause && !audio.ended) return
    if (audio.ended) setPausedUi('متوقف شد')
  })

  channel?.addEventListener('message', event => {
    const message = event.data || {}
    if (message.tabId === tabId) return
    if (message.type === 'rml-audio-started') pauseBecauseAnotherSourceStarted()
  })

  window.addEventListener('storage', event => {
    if (event.key !== ownerKey) return
    if (hasActiveOtherOwner()) pauseBecauseAnotherSourceStarted()
  })

  window.addEventListener('beforeunload', releaseOwner)

  if (hasActiveOtherOwner()) {
    setPausedUi('در یک صفحه دیگر در حال پخش است')
  }
}

function escapeHtml(value) {
  return String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;')
}

function escapeAttribute(value) {
  return escapeHtml(value).replaceAll('`', '&#096;')
}

document.addEventListener('DOMContentLoaded', () => {
  initTheme()
  initMobileMenu()
  initPersonalization()
  initStars()
  initTimeline()
  initMemoryModal()
  initVibeSpinner()
  initQuiz()
  initInviteCopy()
  initBackgroundMusic()
})
