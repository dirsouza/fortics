module.exports = {
  clearMocks: true,
  collectCoverage: true,
  collectCoverageFrom: [
    '<rootDir>/src/**/*.ts',
    '!<rootDir>/src/configs/**',
    '!<rootDir>/src/interfaces/**',
  ],
  coverageDirectory: 'coverage',
  coverageProvider: 'babel',
  preset: 'ts-jest',
  roots: [
    '<rootDir>/src',
  ],
  testEnvironment: 'node',
  transform: {
    '.+\\.ts$': 'ts-jest',
  },
}
