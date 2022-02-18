import { useMediaQuery } from 'react-responsive';

import CloseIcon from '@mui/icons-material/Close';

import './style.scss';

// import '../Home/style.scss';

const PopUpDel = () => {
  // breakpoints variables for react-responsive
  const isDesktopOrLaptop = useMediaQuery({
    query: '(min-width: 1440px)',
  });

  const isTabletOrMobile = useMediaQuery({ query: '(max-width: 1224px)' });

  return (
    <div className="PopUpDel bounce">
      {isDesktopOrLaptop && <p>Profil supprimé</p>}
      {isTabletOrMobile && <CloseIcon sx={{ fontSize: 40 }} />}
    </div>
  );
};

export default PopUpDel;
