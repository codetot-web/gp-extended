import {
	select,
	addClass,
	removeClass,
	hasClass,
	on,
	getData,
	setAttribute
} from 'lib/dom'

export default el => {
	const triggerEl = select('.js-trigger', el)
	const triggerTextEl = select('.js-trigger-text', el)
	const wrapperContentEl = select('.js-wrapper-content', el)
	const contentEl = select('.js-content', el)
	const maxHeight = getData('max-height', el)
	const openText = getData('open-text', el)
	const closeText = getData('close-text', el)
	const ACTIVE_CLASS = 'is-active'

	const contentHeight = contentEl.scrollHeight

	const init = () => {
		if (contentHeight < maxHeight) {
			wrapperContentEl.removeAttribute('style')
			addClass('not-available', el)
		} else {
			addClass('is-available', el)
		}
	}

	const changeButtonText = text => {
		triggerTextEl.innerHTML = text
	}

	const setContentHeight = height => {
		setAttribute(
			'style',
			`overflow: hidden; height: ${height}`,
			wrapperContentEl
		)
	}

	const open = () => {
		addClass(ACTIVE_CLASS, el)

		changeButtonText(closeText)
		setContentHeight('auto')
	}

	const close = () => {
		removeClass(ACTIVE_CLASS, el)

		changeButtonText(openText)
		setContentHeight(`${maxHeight}px`)
	}

	if (triggerEl && contentEl) {
		init()

		on(
			'click',
			() => {
				if (hasClass(ACTIVE_CLASS, el)) {
					close()
					window.scrollTo({ top: el.offsetTop, behavior: 'smooth' })
				} else {
					open()
				}
			},
			triggerEl
		)
	}
}
