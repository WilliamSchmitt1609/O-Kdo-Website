import './style.scss';

// Icons import
import FacebookIcon from '@mui/icons-material/Facebook';
import TwitterIcon from '@mui/icons-material/Twitter';
import InstagramIcon from '@mui/icons-material/Instagram';
// import { deepOrange } from '@mui/material/colors';

// This component contains the footer of our website with social media icons

const Footer = () => (

  <footer className="footer">
    <a href="https://fr-fr.facebook.com/">
      <FacebookIcon
        className="icon"
        // sx={{ color: deepOrange[50] }}
        fontSize="large"
      />
    </a>
    <a href="https://twitter.com/?lang=fr">
      <TwitterIcon
        className="icon"
        // sx={{ color: deepOrange[50] }}
        fontSize="large"
      />
    </a>
    <a href="https://www.instagram.com/">
      <InstagramIcon
        className="icon"
        // sx={{ color: deepOrange[50] }}
        fontSize="large"
      />
    </a>
  </footer>
);

export default Footer;
