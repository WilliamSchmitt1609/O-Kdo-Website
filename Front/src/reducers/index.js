// importing the action creator to be used in the reducer
import {
  OPEN_MENU,
  CLOSE_MENU,
  OPEN_LOGIN,
  CLOSE_LOGIN,
  OPEN_SAVE_PROFILE,
  SAVE_CATEGORIES,
  SAVE_EVENTS,
  SAVE_AGES,
  SAVE_GENDER,
  SAVE_PROFILES,
  PUSH_NAME,
  LOADER_OFF,
  SAVE_PRODUCTS,
  DISPLAY_ERROR,
  SAVE_SEARCH,
  EMPTY_SEARCH,
  CLOSE_SAVE_PROFILE,
  SEARCH_TO_API,
  FADE_SWITCH,
  FADE_SWITCH_ON,
  DISPLAY_REQUIRED_INFOS,
  HIDE_REQUIRED_INFOS,
  SHOW_POPUP_DEL,
  HIDE_POPUP_DEL,
} from 'src/actions/okdo';

import {
  INPUT_CHANGE,
  SAVE_USER_TOKEN,
  IMPORT_USER_TOKEN,
  SAVE_USER_INFOS,
  LOG_OUT,
  STATE_DELETE_PROFILE,
  LOG_IN,
  PUSH_EDIT_PROFIL,
  SAVE_PROFIL_API,
  CREATE_ACCOUNT,
} from 'src/actions/user';

const initialState = {
  // isClicked is set on false at start. The component will appear (set to !false)
  // on click on the burger menu
  burgerIsClicked: false,

  // login popUp will appear on click  on the login icon
  loginIsClicked: false,

  // Save poppUP will appear on click on the save icon
  saveIsClicked: false,
  // mail connexion input
  mailLogin: '',
  // password connexion input
  passwordLogin: '',
  // profil registered input
  registeredProfil: '',
  // First Name Sign in input
  firstNameSignIn: '',
  // Last Name Sign in input
  lastNameSignIn: '',
  // email input in register form
  mailSignIn: '',
  // password input in register form
  passwordSignIn: '',

  // edit name profile input input in edit profile form
  editNameProfileInput: '',

  // User is logged ?
  isLogged: false,

  // ages options for search form
  ages: [],
  // event options for search form
  events: [],
  // gender options for search form
  gender: [],
  // categories options for search form
  categories: [],
  // profiles saved from API
  profiles: [],
  // profile id to delete
  idToSupp: '',
  // user Token
  token: '',
  // user Firstname
  firstname: '',
  // user Role
  role: '',
  // userId
  id: '',

  loading: false,
  // category chosen by user on profile edit page
  categoryChosen: [],
  // age chosen by user on profile edit page
  ageChosen: [],
  // gender chosen by user on profile edit page
  genderChosen: '',
  // event chosen by user on profile edit page
  eventChosen: '',
  // id linked to chosen select on profile edit page
  idChosen: '',
  // storing the response of gift product search button of homepage
  productResearch: [],

  categoriesSearch: [],

  agesSearch: [],

  genderSearch: [],

  eventSearch: [],

  fadeProp: true,

  // display for the required select on home
  display: false,

  // displayfor the popUp delte profile
  showPopUpDel: false,

};

const reducer = (state = initialState, action = {}) => {
  // following action type, action will react step by step
  switch (action.type) {
    case OPEN_MENU:
      return {
        ...state,
        burgerIsClicked: true,
      };
    case CLOSE_MENU:
      return {
        ...state,
        burgerIsClicked: 'close',
      };
    case OPEN_LOGIN:
      return {
        ...state,
        loginIsClicked: true,
      };
    case CLOSE_LOGIN:
      return {
        ...state,
        loginIsClicked: 'close',
      };
    case OPEN_SAVE_PROFILE:
      return {
        ...state,
        saveIsClicked: true,
      };
    case CLOSE_SAVE_PROFILE:
      return {
        ...state,
        saveIsClicked: false,
      };
    case INPUT_CHANGE:
      return {
        ...state,
        [action.identifier]: action.value,
      };
    case SAVE_CATEGORIES:
      return {
        ...state,
        categories: action.categories,
      };
    case SAVE_EVENTS:
      return {
        ...state,
        events: action.events,
      };
    case SAVE_AGES:
      return {
        ...state,
        ages: action.ages,
      };
    case SAVE_GENDER:
      return {
        ...state,
        gender: action.gender,
        // loading: false,
      };
    case SAVE_USER_TOKEN:
      return {
        ...state,
        isLogged: true,
        token: action.token,
        loginIsClicked: 'close',
        mailLogin: '',
        passwordLogin: '',
      };
    case IMPORT_USER_TOKEN:
      return {
        ...state,
        token: action.token,
        firstname: action.firstname,
        lastname: action.lastname,
        // We add it in an array to reproduce what we receive from the api at start
        role: [action.role],
        isLogged: true,
      };

    case SAVE_USER_INFOS:
      return {
        ...state,
        firstname: action.firstname,
        lastname: action.lastname,
        role: action.role,
        id: action.id,
      };

    case LOG_IN:
      return {
        ...state,
        loading: true,
        loginIsClicked: false,
        burgerIsClicked: false,
      };

    case LOG_OUT:
      return {
        ...state,
        token: '',
        firstname: '',
        lastname: '',
        role: '',
        isLogged: false,
        loginIsClicked: 'close',
        profiles: [],
        loading: false,
        fadeProp: true,
      };

    case SAVE_PROFILES:
      return {
        ...state,
        profiles: action.profiles,
        loading: false,
      };

    case STATE_DELETE_PROFILE:
      return {
        ...state,
        idToSupp: action.idToSupp,
      };

    case PUSH_NAME:
      return {
        ...state,
        editNameProfileInput: action.name,
      };

    case PUSH_EDIT_PROFIL:
      return {
        ...state,
        categoryChosen: action.categories,
        ageChosen: action.ages,
        genderChosen: action.sex,
        eventChosen: action.event,
        idChosen: action.id,
      };

    case LOADER_OFF:
      return {
        ...state,
        loading: false,
      };

    case SAVE_PRODUCTS:
      return {
        ...state,
        productResearch: action.products.data,
        loginIsClicked: false,
      };

    case DISPLAY_ERROR:
      return {
        ...state,
      };

    case SAVE_SEARCH:
      return {
        ...state,
        categoriesSearch: action.cat,
        agesSearch: action.ages,
        genderSearch: action.sex,
        eventSearch: action.evt,
      };

    case EMPTY_SEARCH:
      return {
        ...state,
        categoriesSearch: [],
        agesSearch: [],
        genderSearch: [],
        eventSearch: [],
        productResearch: [],
        loading: true,
      };

    case SAVE_PROFIL_API:
      return {
        ...state,
        saveIsClicked: false,
        registeredProfil: '',
      };

    case CREATE_ACCOUNT:
      return {
        ...state,
        firstNameSignIn: '',
        lastNameSignIn: '',
        mailSignIn: '',
        passwordSignIn: '',
      };

    case SEARCH_TO_API:
      return {
        ...state,
        burgerIsClicked: false,
      };

    case FADE_SWITCH:
      return {
        ...state,
        fadeProp: false,
      };

    case FADE_SWITCH_ON:
      return {
        ...state,
        fadeProp: true,
      };

    case DISPLAY_REQUIRED_INFOS:
      return {
        ...state,
        display: true,
      };

    case HIDE_REQUIRED_INFOS:
      return {
        ...state,
        display: false,
      };

    case SHOW_POPUP_DEL:
      return {
        ...state,
        showPopUpDel: true,
      };

    case HIDE_POPUP_DEL:
      return {
        ...state,
        showPopUpDel: false,
      };

    default:
      return state;
  }
};

// exporting it to be reused elsewhere
export default reducer;
