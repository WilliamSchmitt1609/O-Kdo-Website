// Controlled input for mail login
export const INPUT_CHANGE = 'INPUT_CHANGE';

export const inputChange = (value, identifier) => ({
  type: INPUT_CHANGE,
  value: value,
  identifier: identifier,
});

export const LOG_IN = 'LOG_IN';

export const logIn = () => ({
  type: LOG_IN,
});

export const LOG_OUT = 'LOG_OUT';

export const logOut = () => ({
  type: LOG_OUT,
});

export const SAVE_USER_TOKEN = 'SAVE_USER_TOKEN';

export const saveUserToken = (token) => ({
  type: SAVE_USER_TOKEN,
  token: token,
});

// Retrieve Token in the localStorage
export const IMPORT_USER_TOKEN = 'IMPORT_USER_TOKEN';

export const importUserToken = (token) => ({
  type: IMPORT_USER_TOKEN,
  token: token,
});

// Send the token to get the infos
export const GET_INFOS = 'GET_INFOS';

export const getInfos = () => ({
  type: GET_INFOS,
});

export const SAVE_USER_INFOS = 'SAVE_USER_INFOS';
// Save the infos in the state after the get request to the API
export const saveUserInfos = (firstname, lastname, role, id) => ({
  type: SAVE_USER_INFOS,
  firstname: firstname,
  lastname: lastname,
  role: role,
  id: id,
});

export const STATE_DELETE_PROFILE = 'STATE_DELETE_PROFILE';

export const stateDeleteProfile = (id) => ({
  type: STATE_DELETE_PROFILE,
  idToSupp: id,
});

export const DELETE_PROFILE = 'DELETE_PROFILE';

export const deleteProfile = () => ({
  type: DELETE_PROFILE,
});

export const PUSH_EDIT_PROFIL = 'PUSH_EDIT_PROFIL';

export const pushEditProfil = (categories, ages, sex, event, id) => ({
  type: PUSH_EDIT_PROFIL,
  categories: categories,
  ages: ages,
  sex: sex,
  event: event,
  id: id,
});

export const UPDATE_PROFILE = 'UPDATE_PROFILE';

export const updateProfile = () => ({
  type: UPDATE_PROFILE,
});

export const SAVE_PROFIL_API = 'SAVE_PROFIL_API';

export const saveProfilApi = () => ({
  type: SAVE_PROFIL_API,
});

export const CREATE_ACCOUNT = 'CREATE_ACCOUNT';

export const createAccount = () => ({
  type: CREATE_ACCOUNT,
});
