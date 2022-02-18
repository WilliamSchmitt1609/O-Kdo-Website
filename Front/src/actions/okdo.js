// Action creators of the website

export const OPEN_MENU = 'OPEN_MENU';

export const openMenu = () => ({
  type: OPEN_MENU,
});

export const CLOSE_MENU = 'CLOSE_MENU';

export const closeMenu = () => ({
  type: CLOSE_MENU,
});

export const OPEN_LOGIN = 'OPEN_LOGIN';

export const openLogin = () => ({
  type: OPEN_LOGIN,
});

export const CLOSE_LOGIN = 'CLOSE_LOGIN';

export const closeLogin = () => ({
  type: CLOSE_LOGIN,
});

export const OPEN_SAVE_PROFILE = 'OPEN_SAVE_PROFILE';

export const openSaveProfile = () => ({
  type: OPEN_SAVE_PROFILE,
});

export const CLOSE_SAVE_PROFILE = 'CLOSE_SAVE_PROFILE';

export const closeSaveProfile = () => ({
  type: CLOSE_SAVE_PROFILE,
});

// API Actions

export const FETCH_AGES = 'FETCH_AGES';

export const fetchAges = () => ({
  type: FETCH_AGES,
});

export const SAVE_AGES = 'SAVE_AGES';

export const saveAges = (ages) => ({
  type: SAVE_AGES,
  ages: ages,
});

export const FETCH_EVENTS = 'FETCH_EVENTS';

export const fetchEvents = () => ({
  type: FETCH_EVENTS,
});

export const SAVE_EVENTS = 'SAVE_EVENTS';

export const saveEvents = (events) => ({
  type: SAVE_EVENTS,
  events: events,
});

export const FETCH_CATEGORIES = 'FETCH_CATEGORIES';

export const fetchCategories = () => ({
  type: FETCH_CATEGORIES,
});

export const SAVE_CATEGORIES = 'SAVE_CATEGORIES';

export const saveCategories = (categories) => ({
  type: SAVE_CATEGORIES,
  categories: categories,
});

export const FETCH_GENDER = 'FETCH_GENDER';

export const fetchGender = () => ({
  type: FETCH_GENDER,
});

export const SAVE_GENDER = 'SAVE_GENDER';

export const saveGender = (gender) => ({
  type: SAVE_GENDER,
  gender: gender,
});

export const CATEGORY_SELECTION = 'CATEGORY_SELECTION';

export const categorySelection = (value) => ({
  type: CATEGORY_SELECTION,
  categorySelected: { label: value, value: value },
});

export const FETCH_PROFILES = 'FETCH_PROFILES';

export const fetchProfiles = () => ({
  type: FETCH_PROFILES,
});

export const SAVE_PROFILES = 'SAVE_PROFILES';

export const saveProfiles = (profiles) => ({
  type: SAVE_PROFILES,
  profiles: profiles,
});

export const PUSH_NAME = 'PUSH_NAME';

export const pushName = (name) => ({
  type: PUSH_NAME,
  name: name,
});

export const LOADER_OFF = 'LOADER_OFF';

export const loaderOff = () => ({
  type: LOADER_OFF,
});

export const FETCH_PRODUCTS = 'FETCH_PRODUCTS';

export const fetchProducts = () => ({
  type: FETCH_PRODUCTS,
});

export const SAVE_PRODUCTS = 'SAVE_PRODUCTS';

export const saveProducts = (products) => ({
  type: SAVE_PRODUCTS,
  products: products,
});

export const DISPLAY_ERROR = 'DISPLAY_ERROR';

export const displayError = () => ({
  type: DISPLAY_ERROR,
});

export const SAVE_SEARCH = 'SAVE_SEARCH';

export const saveSearch = (cat, ages, sex, evt) => ({
  type: SAVE_SEARCH,
  cat: cat,
  ages: ages,
  sex: sex,
  evt: evt,
});

export const EMPTY_SEARCH = 'EMPTY_SEARCH';

export const emptySearch = () => ({
  type: EMPTY_SEARCH,
});

export const SEARCH_TO_API = 'SEARCH_TO_API';

export const searchToApi = () => ({
  type: SEARCH_TO_API,
});

export const FADE_SWITCH = 'FADE_SWITCH';

export const fadeSwitch = () => ({
  type: FADE_SWITCH,
});

export const FADE_SWITCH_ON = 'FADE_SWITCH_ON';

export const fadeSwitchOn = () => ({
  type: FADE_SWITCH_ON,
});

export const DISPLAY_REQUIRED_INFOS = 'DISPLAY_REQUIRED_INFOS';

export const displayRequiredInfos = () => ({
  type: DISPLAY_REQUIRED_INFOS,
});

export const HIDE_REQUIRED_INFOS = 'HIDE_REQUIRED_INFOS';

export const hideRequiredInfos = () => ({
  type: HIDE_REQUIRED_INFOS,
});

export const SHOW_POPUP_DEL = 'SHOW_POPUP_DEL';

export const showPopUpDel = () => ({
  type: SHOW_POPUP_DEL,
});

export const HIDE_POPUP_DEL = 'HIDE_POPUP_DEL';

export const hidePopUpDel = () => ({
  type: HIDE_POPUP_DEL,
});
