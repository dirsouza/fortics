import { http } from "../suports";
import SessionService from "./SessionService";

describe('SessionService', () => {
  it('should make a session creation request successfylly', async () => {
    http.post = jest.fn().mockResolvedValue({
      success: true
    });

    const result = await SessionService.create({
      name: 'any_name',
      platform_type: "Telegram",
      contact_identifier: 1234567899,
      message: 'any_message'
    });

    expect(result).toEqual({
      success: true
    });
  });

  it('should make a session creation request with error', async () => {
    http.post = jest.fn().mockResolvedValue({
      success: false
    });

    const result = await SessionService.create({
      name: 'any_name',
      platform_type: "Telegram",
      contact_identifier: 1234567899,
      message: 'any_message'
    });

    expect(result).toEqual({
      success: false
    })
  });
})
